/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_itoa.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/05/30 11:16:59 by mmacdona          #+#    #+#             */
/*   Updated: 2017/10/01 02:11:45 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

#define MIN (-2147483648)
#define MAX 2147483647

static int	count_num(int n)
{
	int count;

	count = 0;
	while (n > 0)
	{
		count++;
		n /= 10;
	}
	return (count);
}

static char	*make_string(int n)
{
	int		count;
	int		i;
	char	*temp;

	i = 0;
	count = 0;
	if (n < 0)
	{
		count++;
		n *= -1;
	}
	count += count_num(n);
	if (n == 0)
	{
		temp = ft_strnew(1);
		temp[0] = '0';
	}
	else
		temp = ft_strnew(count);
	return (temp);
}

static char	*min_max_str(int n)
{
	char *str;

	if (n == MAX)
	{
		str = ft_strnew(ft_strlen("2147483647"));
		str = ft_strcpy(str, "2147483647");
		return (str);
	}
	if (n == MIN)
	{
		str = ft_strnew(ft_strlen("-2147483648"));
		str = ft_strcpy(str, "-2147483648");
		return (str);
	}
	return (NULL);
}

static int	get_neg(int n)
{
	if (n < 0)
		return (1);
	return (0);
}

char		*ft_itoa(int n)
{
	size_t	i;
	char	*str;
	int		neg;

	neg = n;
	if (min_max_str(n) != NULL)
		return (min_max_str(n));
	str = make_string(n);
	if (str == NULL)
		return (NULL);
	if (neg < 0)
		n *= -1;
	if (n == 0)
		return (str);
	i = count_num(n) + get_neg(neg);
	while (i > 0)
	{
		str[i - 1] = (n % 10) + '0';
		n /= 10;
		i--;
	}
	if (neg < 0)
		str[0] = '-';
	return (str);
}
