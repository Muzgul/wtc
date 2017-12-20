#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include "libft/libft.h"

int read_info(char ***grid, char ***piece);
int valid_placement(char **grid, char **piece, int y, int x);
void read_grid(char ***grid);
void read_piece(char ***piece);
int make_move(char **grid, char **piece, int step);
int x_offset(char **piece);
int y_offset(char **piece);
int quadrant_check(char **grid, char player);
int distance_check(char **piece, int pos_y, int pos_x, int dest_y, int dest_x);
int build_to(char **grid, char **piece, int limit, int dest_y, int dest_x);
int best_edge(char **grid, int context);
int edge_touch(int q1, int q2);

int main()
{
	char *line;
	char **grid;
	char **piece;
	int step;

	//Skip all initial content
	get_next_line(0, &line);
	while (ft_strncmp(line, "$$$", 3) != 0)
		get_next_line(0, &line);

	//Execute Filler
	step = 1;
	while (1 == 1)
	{
		read_grid(&grid);
		read_piece(&piece);
		if ((step = make_move(grid, piece, step)) == -1)
		{
			ft_putnbr(0);
			ft_putchar(' ');
			ft_putnbr(0);
			ft_putchar('\n');
		}
	}
	return (2);
}

int make_move(char **grid, char **piece, int step)
{
	int temp;
	int grid_y;
	int grid_x;
	int new_step;
	double edges[4][2] = {
		{0, 0.5},
		{0.5, 1},
		{1, 0.5},
		{0.5, 0}
	};

	new_step = -1;
	grid_y = 0;
	while (grid[grid_y] != NULL)
		grid_y++;
	grid_x = 0;
	while (grid[0][grid_x] != '\0')
		grid_x++;
	if (step == 1)
	{
		temp = build_to(grid, piece, 0, (grid_y / 2), (grid_x / 2));
		if (temp < 3)
			new_step = 2;
	}
	if (step == 2)
	{
		temp = best_edge(grid, 0);
		temp = build_to(grid, piece, 0, ((grid_y - 1) * edges[temp][0]), ((grid_x - 1) * edges[temp][1]));
		if (temp < 3)
			new_step = 3;
	}
	if (step == 3)
	{
		temp = best_edge(grid, 1);
		temp = build_to(grid, piece, 0, ((grid_y - 1) * edges[temp][0]), ((grid_x - 1) * edges[temp][1]));
		if (temp < 3)
			new_step = 4;
	}
	if (step == 4)
		temp = build_to(grid, piece, 0, rand() % (grid_y - 1), rand() % (grid_x - 1));
	if (temp == -1)
		return (temp);
	if (new_step != -1)
		step = new_step;
	return (step);
}

int best_edge(char **grid, int context)
{
	int p1_quad;
	int p2_quad;

	p1_quad = quadrant_check(grid, 'o');
	if (p1_quad == -1)
		p1_quad = quadrant_check(grid, 'O');
	p2_quad = quadrant_check(grid, 'x');
	if (p2_quad == -1)
		p2_quad = quadrant_check(grid, 'X');
	if (context == 0)
		return (edge_touch(p1_quad, p2_quad));
	return (edge_touch(p2_quad, p1_quad));
}

int edge_touch(int q1, int q2)
{
	if ((q1 == 2 && q2 == 1) || (q1 == 3 && q2 == 1))
		return (0);
	if ((q1 == 0 && q2 == 3) || (q1 == 2 && q2 == 3))
		return (1);
	if ((q1 == 1 && q2 == 2) || (q1 == 0 && q2 == 2))
		return (2);
	if ((q1 == 3 && q2 == 0) || (q1 == 1 && q2 == 0))
		return (3);
	return (-1);
}

int build_to(char **grid, char **piece, int limit, int dest_y, int dest_x)
{
	int best_dist;
	int best_x;
	int best_y;
	int temp_dist;
	int x, y;
	int x_off, y_off;

	//Loop to find first possible placement (from top left)
	best_dist = -1;
	x_off = x_offset(piece);
	y_off = y_offset(piece);
	y = 0;
	while (grid[y] != NULL)
	{
		x = 0;
		while (grid[y][x] != '\0')
		{
			if (valid_placement(grid, piece, y - y_off, x - x_off) == 1)
				{
					//printf("%i %i\n", y, x);
					temp_dist = distance_check(piece, y - y_off, x - x_off, dest_y, dest_x);
					if (temp_dist < best_dist || best_dist == -1)
					{
						best_dist = temp_dist;
						best_y = y;
						best_x = x;
					}
				}
			x++;
		}
		y++;
	}
	if (best_dist != -1 && best_dist >= limit)
	{
		ft_putnbr(best_y - y_off);
		ft_putchar(' ');
		ft_putnbr(best_x - x_off);
		ft_putchar('\n');
		return (best_dist);
	}
	return (best_dist);

}

int distance_check(char **piece, int pos_y, int pos_x, int dest_y, int dest_x)
{
	int distance;
	int temp_dist;
	int x, y;
	int temp_x;
	int temp_y;

	distance = -1;
	temp_dist = 0;
	y = 0;
	while (piece[y] != NULL)
	{
		x = 0;
		while (piece[y][x] != '\0')
		{
			if (piece[y][x] == '*')
			{
				temp_x = (x + pos_x) - dest_x;
				temp_x = temp_x * temp_x;
				temp_y = (y + pos_y) - dest_y;
				temp_y = temp_y * temp_y;
				temp_dist = temp_x + temp_y;
				if (temp_dist < distance || distance == -1)
					distance = temp_dist;
			}
			x++;
		}
		y++;
	}
	return (distance);
}

int quadrant_check(char **grid, char player)
{
	int x;
	int y;
	int grid_y;
	int grid_x;
	int quadrant;

	grid_y = 0;
	while (grid[grid_y] != NULL)
		grid_y++;
	grid_x = 0;
	while (grid[0][grid_x] != '\0')
		grid_x++;
	y = 0;
	while (grid[y] != NULL)
	{
		x = 0;
		while (grid[y][x] != '\0')
		{
			if (grid[y][x] == player)
			{
				if (x < (grid_x / 2))
					quadrant = 0;
				else
					quadrant = 1;
				if (y >= (grid_y / 2))
					quadrant += 2;
				return (quadrant);
			}
			x++;
		}
		y++;
	}
	return (-1);
}

int x_offset(char **piece)
{
	int x;
	int y;

	x = 0;
	y = 0;
	while (piece[y] != NULL && piece[y][x] != '\0')
	{
		while (piece[y] != NULL)
		{
			if (piece[y][x] == '*')
				return (x);
			y++;
		}
		y = 0;
		x++;
	}
	return (0);
}

int y_offset(char **piece)
{
	int x;
	int y;

	y = 0;
	while (piece[y] != NULL)
	{
		x = 0;
		while (piece[y][x] != '\0')
		{
			if (piece[y][x] == '*')
				return(y);
			x++;
		}
		y++;
	}
	return (0);
}

int valid_placement(char **grid, char **piece, int y, int x)
{
	int m;
	int n;
	int grid_y;
	int grid_x;
	int overlap;

	overlap = 0;
	grid_y = 0;
	while (grid[grid_y] != NULL)
		grid_y++;
	grid_x = 0;
	while (grid[0][grid_x] != '\0')
		grid_x++;
	m = 0;
	while (piece[m] != NULL)
	{
		n = 0;
		while (piece[m][n] != '\0')
		{
			if (piece[m][n] == '*')
			{
				if (!(((n + x) >= 0 && (n + x) < grid_x) && ((m + y) >= 0 && (m + y) < grid_y)))
					return (-1);
				if (grid[m + y][n + x] == 'X' || grid[m + y][n + x] == 'x')
					return (-1);
				if (grid[m + y][n + x] == 'O' || grid[m + y][n + x] == 'o')
					overlap++;
			}
			n++;
		}
		m++;
	}
	return (overlap);
}

void	 read_grid(char ***grid)
{
	char *line;
	char **t_grid;
	char **split;
	int grid_row;
	int temp_int;
	int ret;

	//Get Plateau line
	ret = get_next_line(0, &line);
	if (ft_strncmp(line, "Plateau", 7) == 0)
	{
		//split to get grid info
		split = ft_strsplit(line, ' ');
		//read header line ie 1234567890123
		ret = get_next_line(0, &line);
		grid_row = ft_atoi(split[1]);
		t_grid = (char **)malloc(sizeof(char *) * grid_row + 1);
		temp_int = 0;
		//read up to num_rows
		while (temp_int < grid_row && (ret = get_next_line(0, &line)) > 0)
		{
			t_grid[temp_int] = ft_strdup(&line[4]);
			temp_int++;
		}
		t_grid[temp_int] = NULL;
		*grid = t_grid;
    }
    
}

void 	read_piece(char ***piece)
{
	char *line;
	char **t_piece;
	char **split;
	int piece_row;
	int temp_int;
	int ret;

	ret = get_next_line(0, &line);
	if (ft_strncmp(line, "Piece", 5) == 0)
	{
		//split to get grid info
		split = ft_strsplit(line, ' ');
		piece_row = ft_atoi(split[1]);
		t_piece = (char **)malloc(sizeof(char *) * piece_row + 1);
		temp_int = 0;
		//read up untill num_rows
		while (temp_int < piece_row && (ret = get_next_line(0, &line)) > 0)
		{
			t_piece[temp_int] = ft_strdup(line);
			temp_int++;
		}
		t_piece[temp_int] = NULL;
		*piece = t_piece;
	}
	
}