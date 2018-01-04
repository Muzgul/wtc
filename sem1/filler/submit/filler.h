/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   filler.h                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/01/03 11:34:39 by mmacdona          #+#    #+#             */
/*   Updated: 2018/01/03 11:34:41 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef FT_FILLER_H
# define FT_FILLER_H
# include "libft/libft.h"

int		read_info(char ***grid, char ***piece);
int		valid_placement(char **grid, char **piece, int *dest, int player);
void	read_grid(char ***grid);
void	read_piece(char ***piece);
int		make_move(char **grid, char **piece, int step, int player);
int		x_offset(char **piece);
int		y_offset(char **piece);
int		quadrant_check(char **grid, char player);
int		distance_check(char **piece, int pos_y, int pos_x, int *dest);
int		build_to(char **grid, char **piece, int limit, int *dest);
int		best_edge(char **grid, int context);
int		edge_touch(int q1, int q2);
int		get_max(char **arr, char coord);
int		get_player();
int		*get_coord(int y, int x);
int		move_step(char **grid, char **piece, int step, int player);
void	print_move(int y, int x);
int		distance_compare(char **piece, int *point_a, int *point_b, int *dest);

#endif
