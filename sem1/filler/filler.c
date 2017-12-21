#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include "filler.h"

double	g_e[4][2] = {{0, 0.5}, {0.5, 1}, {1, 0.5}, {0.5, 0}};

int		main(void)
{
	char	**grid;
	char	**piece;
	int		step;
	char	player;

	step = 1;
	player = get_player();
	while (1 == 1)
	{
		read_grid(&grid);
		read_piece(&piece);
		if ((step = make_move(grid, piece, step, player)) == -1)
			print_move(0, 0);
	}
	return (2);
}

int		make_move(char **grid, char **piece, int step, int player)
{
	int temp;
	int new_step;

	new_step = -1;
	temp = move_step(grid, piece, step, player);
	if (temp < 3)
		new_step = step + 1;
	if (temp == -1)
		return (temp);
	if (new_step != -1)
		step = new_step;
	return (step);
}

int		move_step(char **grid, char **piece, int step, int player)
{
	int		i;
	int		g_y;
	int		g_x;
	int		*pt;

	g_y = get_max(grid, 'y');
	g_x = get_max(grid, 'x');
	if (step == 1)
		pt = get_coord((g_y / 2), (g_x / 2));
	if (step == 2)
	{
		i = best_edge(grid, (player - '0') - 1);
		pt = get_coord(((g_y - 1) * g_e[i][0]), ((g_x - 1) * g_e[i][1]));
	}
	if (step == 3)
	{
		i = best_edge(grid, 2 - (player - '0'));
		pt = get_coord(((g_y - 1) * g_e[i][0]), ((g_x - 1) * g_e[i][1]));
	}
	if (step > 3)
		pt = get_coord(rand() % (g_y - 1), rand() % (g_x - 1));
	i = build_to(grid, piece, player, pt);
	return (i);
}


// SPLIT BUILD TO UP
//IS SEG FAULTING
//FIGURE OUT WHERE
int		*next_valid(char **grid, char **piece, int *start, int player)
{
	int x;
	int y;
	int *coord;

	if (start == NULL)
		return (get_coord(0, 0));
	y = start[0];
	x = start[1];
	while (grid[y] != NULL)
	{
		while (grid[y][x] != '\0')
		{
			if (y != start[0] && x != start[1])
			{
				coord = get_coord(y - y_offset(piece), x - x_offset(piece));
				if (valid_placement(grid, piece, coord, player) == 1)
					return (get_coord(y, x));
			}
			x++;
		}
		x = 0;
		y++;
	}
	return (NULL);
}
int		build_to(char **grid, char **piece, int player, int *dest)
{
	int best_dist;
	int *best;
	int *temp;
	int temp_dist;
	int *off;

	best_dist = -1;
	best = NULL;
	temp = NULL;
	off = get_coord(y_offset(piece), x_offset(piece));
	temp = next_valid(grid, piece, temp, player);
	while (temp != NULL && temp[0] < get_max(grid, 'y') && temp[1] < get_max(grid, 'x'))
	{
		temp_dist = distance_check(piece, temp[0] - off[0], temp[1] - off[1], dest);
		if (temp_dist < best_dist || best_dist == -1)
		{
			best_dist = temp_dist;
			best = get_coord(best[0], best[1]);
		}
		temp = next_valid(grid, piece, temp, player);
	}
	if (best_dist >= 0)
	{
		print_move(best[0] - off[0], best[1] - off[1]);
		return (best_dist);
	}
	return (best_dist);
}
